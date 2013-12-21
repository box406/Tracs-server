# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "centos6.4"
  config.vm.box_url = "https://dl.dropbox.com/u/7225008/Vagrant/CentOS-6.3-x86_64-minimal.box"
  config.vm.network :private_network, ip: "192.168.33.10"


  src_dir = './sandbox'
  doc_root = '/vagrant_data'
  config.vm.synced_folder src_dir, doc_root, :create => true, :owner=> 'vagrant', :group=>'nginx', mount_options: ['dmode=775,fmode=775']

  config.vm.provision :chef_solo do |chef|
    chef.cookbooks_path = ["cookbooks"]

    chef.add_recipe "yum::epel"
    chef.add_recipe "yum::remi"
    chef.add_recipe "nginx"
    chef.add_recipe "mysql"
    chef.add_recipe "php"
    chef.add_recipe "iptables"
 
    # You may also specify custom JSON attributes:
    #chef.json = { :mysql_password => "foo" }
 
    chef.json = {
        "php" => {
            "timezone" => "Asia/Tokyo",
            "display_errors" => "on"
        },
        "php-fpm" => {
            "user" => "nginx",
            "group" => "nginx",
            "error_log" => "/var/log/php-fpm/www-error.log"
        },
        "mysql" => {
            "root_pass" => "njA8m3at",
            "project_pass" => "jakaruta406",
            "project_database" => "trac"
        },
        "nginx" => {
            "document_root" => "/vagrant_data/public",
            "access_log" => "/var/log/nginx/access.log"
        }

    }
  end
end
