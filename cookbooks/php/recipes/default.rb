#
# Cookbook Name:: php
# Recipe:: default
#
# Copyright 2013, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w{php php-fpm php-pear php-cli php-common php-devel php-gd php-mbstring php-mysql php-pdo php-xml php-pecl-apc php-mcrypt}.each do |suffix|
  package suffix do
    action [:install, :upgrade]
  end
end

execute "phpunit-install" do
  command "pear config-set auto_discover 1; pear install pear.phpunit.de/PHPUnit"
  not_if { ::File.exists?("/usr/bin/phpunit")}
end

execute "composer-install" do
  command "curl -sS https://getcomposer.org/installer | php ;mv composer.phar /usr/local/bin/composer"
  not_if { ::File.exists?("/usr/local/bin/composer")}
end

template "/etc/php.ini" do
  source "php.ini.erb"
  owner "root"
  group "root"
  mode 0644
end

template "/etc/php-fpm.d/www.conf" do
  source "www.conf.erb"
  owner "root"
  group "root"
  mode 0644
end


service "php-fpm" do
  action [ :enable, :start ]
end