task :help do
    system "rake -T -a"
end

namespace :local do
    desc "Bring up the local docker environment"
    task :up do
        `composer install`
        `npm install`
        `docker-compose up -d`
    end

    desc "Take down the local docker environment"
    task :down do
        `docker-compose down -t 0`
    end

    desc "Destroy the local environment"
    task :destroy do
        `docker-compose down -v --rmi all --remove-orphans`
    end

    namespace :database do
        desc "Imports a bare WordPress database configured for use with multisite. Eases multi site setup."
        task :seed do
            `mysql -h 127.0.0.1 -u wordpress -psecret wordpress < assets/seed.sql`
        end

        desc "Import a specified SQL file."
        task :import do
            `docker-compose exec -T -e MYSQL_PWD=wordpress database mysql -u wordpress wordpress #{$stdin}`
        end

        desc "Take a backup of the local database and put in 'assets/backups' with a timestamp."
        task :backup do
           `docker-compose exec -e MYSQL_PWD=wordpress database mysqldump -h 127.0.0.1 -u wordpress wordpress | gzip -c > ./assets/backups/db-$( date '+%Y-%m-%d_%H-%M-%S' ).sql.gz` 
        end
    end
end
