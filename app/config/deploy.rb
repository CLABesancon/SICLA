set :application, "sidus"
set :domain,      "#{application}.fr"
ssh_options[:port] = "2222"
set :deploy_to,   "/home/www/#{application}"
set :deploy_via,  :remote_cache
set :app_path,    "app"

set :repository,  "git@github.com:VincentChalnot/SidusAdmin.git"
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

set :use_sudo,      false
set :keep_releases, 3

set :shared_files, ["app/config/parameters.yml"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]
set :use_composer, true
set :update_vendors, true
set :git_enable_submodules, 1

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL
