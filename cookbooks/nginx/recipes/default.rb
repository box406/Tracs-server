#
# Cookbook Name:: nginx
# Recipe:: default
#
# Copyright 2013, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
template "/etc/yum.repos.d/nginx.repo" do
  source "nginx.repo.erb"
  owner "root"
  group "root"
  mode 0644
end

package "nginx" do
  #version "1.4.2"
  action [:install, :upgrade]
end

template "/etc/nginx/conf.d/default.conf" do
  source "default.conf.erb"
  owner "root"
  group "root"
  mode 0644
end

service "nginx" do
  action [ :enable, :restart ]
end

