# アプリケーション名
お問い合わせフォーム(mycotact-form)
## 環境構築
github.com:coachtech-material/laravel-docker-template.git
docker-compose build
docker-compose up -d

docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
## 使用技術(実行環境)
Laravel 8.83.8
PHP 7.4.9
mysql  Ver 15.1 
Docker
## ER図
< - - - 作成したER図の画像 - - - >

## URL
開発環境：http://localhost/
'/' 問い合わせフォーム
'/login' 管理者ユーザーのログインフォーム
'/register'　管理者ユーザーが登録をするためのフォーム
'/admin' 問い合わせのデータ格納
'/confirm'　問い合わせ内容の確認
'/thanks' 問い合わせありがとうございましたページ
