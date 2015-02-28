#!/bin/bash

renice +15 --pid $$

# settings:
LOGFILE="/var/log/mythtv/rokuencode.log"
DATABASEUSER=mythtv
DATABASEPASSWORD=mythtv
HANDBRAKE_PRESET=Normal
REMOVE_MPEG=false

# find HandBrakeCLI
handbrake=$(which HandBrakeCLI)
if [ ! -f $handbrake ]; then
  date=`date`
  echo "$date: rokuencode.sh requires HandBrakeCLI" >> $LOGFILE
  exit 1
fi

#convert mpeg file to mp4 using handbrakecli
MYTHDIR=$1
MPGFILE=$2

newbname=`echo $MPGFILE | sed 's/\(.*\)\..*/\1/'`
newname="$MYTHDIR/$newbname.mp4"

date=`date`
echo "$date: Roku Encode $MPGFILE to $newname" >> $LOGFILE

date=`date`
echo "$newbname:$date Encoding" >> $LOGFILE
$handbrake --preset="$HANDBRAKE_PRESET" -i $MYTHDIR/$MPGFILE -o $newname

# update the db to point to the mp4
date=`date`
echo "$newbname:$date Database/remove" >> $LOGFILE
NEWFILESIZE=`du -b "$newname" | cut -f1`
echo "UPDATE recorded SET basename='$newbname.mp4',filesize='$NEWFILESIZE' WHERE basename='$2';" | mysql --user=$DATABASEUSER --password=$DATABASEPASSWORD mythconverg

# update the seek table
date=`date`
echo "$newname:$date Seek Table/update" >> $LOGFILE
mythcommflag --file $newname --rebuild

# remove the original mpg if doing so will not delete the new file. Note: when
# the recording is deleted using the roku, this original file will be deleted ,
# but not if deleted from mythtv frontend or mythweb. see
# http://www.mythtv.org/wiki/Find_orphans.py for a solution.
if [ $newname != $MYTHDIR/$MPGFILE ] & [ $REMOVE_MPEG ]; then
    date=`date` echo "$MYTHDIR/$MPGFILE:$date File/remove" >> $LOGFILE
    rm $MYTHDIR/$MPGFILE
fi

date=`date`
echo "$date: Roku Encode $newbname Complete" >> $LOGFILE
echo "" >> $LOGFILE
