<<<<<<< HEAD
#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart web-stack"
service php5-fpm restart
service nginx restart
=======
#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart web-stack"
service php5-fpm restart
service nginx restart
>>>>>>> 26e6a9027d9982bca5d190bccaede4466456a605
service mysql restart