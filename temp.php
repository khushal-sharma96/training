<?php
    class Prent{
        protected $admin;
    }
    class chld extends Prent{
        public function __construct(){
            $this->admin="KS";
            echo $this->admin;
        }
    }
    $obj=new chld();
/*
    Tracker ENV
ICON='public/static/icons/icon.png'
WEBPACK_DEV_SERVER_URL=http://localhost:8080/
BASE_URL=http://192.168.1.25:8000/api
VUE_APP_BASE_URL=http://192.168.1.25:8000/api
WEBSITE_URL = http://192.168.1.25:3000/
# http://192.168.1.12:8000/api/v1/auth/login
NODE_ENV="development"
VUE_APP_CLIENT_SECRET='BZzpNgniipMEatseKt2BfypvjxTxoUTRhJKDpxOu'
VUE_APP_CLIENT_ID=2
VUE_APP_GRANT_TYPE='development'
VUE_APP_SCOPE=''
VUE_APP_GOOGLE_CLIENT_ID="871952255780-9tbbg3ribboro66f3uodn0qpaji9lqp8.apps.googleusercontent.com"

    Web
#CLIENT_ID= 9a29c0b0-f541-42b1-b928-9879af52f438
NODE_OPTIONS="--max-old-space-size=4096"
NUXT_CLIENT_ID= 9a29c0b1-5f4f-4be4-8afe-0f9dc5d575aa
VUE_APP_NAME='Be-Work'
VUE_APP_API_BASE_URL='http://192.168.1.25:8000/api/'
VUE_APP_API_AUTH_URL='http://192.168.1.25:8000/api/v1/auth/'
VUE_APP_SOCKET_URL='http://192.168.1.30:3001'
VITE_APP_BACKEND_APP_URL=http://localhost:8080
PASSPORT_CLIENT_ID=9b71045a-7ba2-4afd-b8bd-f2d01d1525d8
PASSPORT_CLIENT_SECRET=9CbV33blvZlUZ23bWn1fzuHejU6oOHJyOG4RRChD
AUTH_SECRET='wzHy+z]8p1PX<<}rM)!2v-d8(2Xd+~M8'
AUTH_ORIGIN=http://localhost:3000
SENTRY_AUTH_TOKEN=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

VUE_APP_GITHUB_CLIENT_ID="Ov23limSmPpJlznCswKA"
VUE_APP_GITHUB_CLIENT_SECRET="e5ed6f94be8802f3d6673029d0101c050a35eb34"
VUE_APP_GITHUB_REDIRECT_URI="http://192.168.1.25:3000/en-CA/common/socialredirect"

VUE_APP_LINKEDIN_CLIENT_ID = "86uxv5rjgm8fpy"
VUE_APP_LINKEDIN_CLIENT_SECRET="WPL_AP1.xSG2dGlCNcfBJuzt.rgyFWA=="  

VUE_APP_GOOGLE_CLIENT_ID="392212993730-b5pcp12b8nc0v5q2m24initbhtca9n89.apps.googleusercontent.com"
VUE_APP_GOOGLE_CLIENT_SECRET="/*GO*/CSP*/X-_8V19pGOpnd41QbaPcJYCyIQ8BKy*/"
VUE_APP_GOOGLE_SCOPE="email profile openid https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email"
VUE_APP_GOOGLE_REDIRECT_URI="http://localhost:3000"

    Laravel

APP_NAME=Be-work
APP_ENV=local
APP_KEY=base64:Vr4MINhY9YykM5MaiLUTeSP/LfK2KHRGb17C9civ8Ek=
APP_DEBUG=true
APP_URL=http://192.168.1.30:8000
FRONTEND_APP_URL=http://192.168.1.25:3000
NODE_URL=http://192.168.1.30:3001


LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bework
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.outlook.com
MAIL_PORT=587
mail_username=swaran.betasoft@outlook.com
MAIL_PASSWORD='Solutions@314#2324'
MAIL_ENCRYPTION=tls
mail_from_address="swaran.betasoft@outlook.com"
MAIL_FROM_NAME="${APP_NAME}"


AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
CLIENT_ID= 9a33411e-6c61-4619-826c-f350f8d9fab1
CLIENT_SECRET= 8pkqa7UPQDgrgYfr6sL5YXQpMDTfRjD4F4bIygi9

ADMIN_ID='1'

/*
    Uncaught Exception:
Error: ENOENT: no such file or directory, rename '/Users/sunil/Library/Application Support/bee-work-tracker/db/settings.db~' -> '/Users/sunil/Library/Application Support/bee-work-tracker/db/settings.db'

?>
