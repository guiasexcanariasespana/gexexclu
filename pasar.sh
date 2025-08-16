#!/bin/bash

export DEPLOYPATH=/home/canariasexclu/public_html/
/bin/rsync -a --exclude 'index.php' public/ $DEPLOYPATH
