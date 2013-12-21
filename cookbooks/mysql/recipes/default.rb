#
# Cookbook Name:: mysql
# Recipe:: default
#
# Copyright 2013, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
package "mysql-server" do
  action :install
end

template "/etc/my.cnf" do
  source "my.cnf.erb"
  owner "root"
  group "root"
  mode 0644
end

service "mysqld" do
  action [ :enable, :start]
end

# init database
bash "setup mysql" do
  code <<-EOC
    mysql -u root -e "set password for root@localhost=password('#{node[:mysql][:root_pass]}');"
    mysql -u root --password=#{node[:mysql][:root_pass]} -e "create database #{node[:mysql][:project_database]}"
    mysql -u root --password=#{node[:mysql][:root_pass]} -e "grant all on #{node[:mysql][:project_database]}.* to #{node[:mysql][:project_database]}@localhost identified by '#{node[:mysql][:project_pass]}'"
    mysql -u root --password=#{node[:mysql][:root_pass]} -e "flush privileges"
  EOC
  only_if "mysql -u root  -e 'show databases;'"
end

