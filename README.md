# Docker for Apache PHP7.4 Laravel6 MySQL

# 構成
* Apache
* PHP7.4
* Laravel 6
* MySQL 8.0

# 準備
docker desktopを最新の状態にアップデートしておいてください。  
コンテナをビルドする前にディレクトリやファイルを準備します。
```
$ git clone git@bitbucket.org:wheads/docker_laravel6_template.git
```
リポジトリをクローンします。  
### ファイルの確認
`/project/docker/lara6_php74_apache/Dockerfile`  
→これを元にimageを作成します。Laravel構築用にComposerのインストールも含まれています。

`/project/docker/initdb/init.sql`  
→コンテナ立ち上げ時にDBにテーブルを作成する際はここにSQLを記述しておきます。

`/project/docker/docker-compose.yml`  
→これを元にコンテナをビルドします。  
```
    volumes:
      - "./initdb:/docker-entrypoint-initdb.d"
```
 初期SQLを実行しない場合は上記`MySQL`の`valumes`の箇所をコメントアウトしてください。

```
environment:
      MYSQL_DATABASE: sample_db
      MYSQL_USER: sample-user
      MYSQL_PASSWORD: sQ9XtqVM
      MYSQL_ROOT_PASSWORD: Xs5Vht8Y
```
`MySQL`の設定を上記の箇所に記述します。  
DB名、ユーザー名、パスワード、rootパスワードは任意のものを記述します。
  
設定は以上になります。   
それぞれのポートやマウントするディレクトリなどは適宜自由に変更してください。  

# 環境を立ち上げる
設定を元にイメージとコンテナを立ち上げます。
## イメージのビルド
```
$ cd /project/docker/lara6-php74-apache
$ docker build -t my-lara6:php74-apache .
```
イメージをビルドします。`.`を忘れないように...
```
$ docker images
REPOSITORY  TAG           IMAGE ID      CREATED        SIZE
my-lara6    php74-apache  abcdef123456  5 minutes ago  468MB
```
イメージがビルドされていることを確認します。  
## コンテナの作成
続いてコンテナ以下コマンドを実行しコンテナを作成します。
```
$ cd /path/to/my-project/docker
$ docker-compose -p project up -d
```
docker psコマンドで以下のようなNAMEのコンテナが立ち上がっていれば成功です。
```
$ docker ps 
CONTAINER ID        IMAGE                       COMMAND                  CREATED             STATUS              PORTS                  NAMES
39d93f391953        my-lara6:php74-apache       "docker-php-entrypoi…"   47 minutes ago      Up 15 seconds       0.0.0.0:80->80/tcp     myapp-web
f9da5cc5db5e        phpmyadmin/phpmyadmin:5.0   "/docker-entrypoint.…"   47 minutes ago      Up 11 seconds       0.0.0.0:8080->80/tcp   myapp-pma
cbf57953a76e        mysql:8.0                   "docker-entrypoint.s…"   47 minutes ago      Up 9 seconds        3306/tcp, 33060/tcp    myapp-db
```
  
## Laravelのインストール
コンテナ内に入りLaravelのインストールを行います。
```
$ docker exec -it myapp-web bash
```
上記コマンドでwebサーバーコンテナに入ります。
```
# cd ..  ← var/www/htmlに移動
# composer create-project --prefer-dist laravel/laravel html "6.*"  
```
上記コマンドを実行するとLaravelのインストールが始まります。  

## DBの設定
LaravelとDBの接続の設定を行います。  
`html/.env`開いて編集します。(コンテナ内でもホスト側でもOK)  
```
DB_CONNECTION=mysql
DB_HOST=myapp-db
DB_PORT=3306
DB_DATABASE=sampledb
DB_USERNAME=sample-user
DB_PASSWORD=hi2mi4i6
```
上記項目を`docker-compose.yml`に記述した`MySQL`の設定に合わせ書き換えます。  

以上で構築完了です。  
コンテナ内で`php artisan migrate`を実行するとマイグレーションが実行可能の状態です。


# コマンド
```
$ docker exec -it myapp-web bash
```
webサーバーコンテナに入る
```
$ docker exec -it myapp-db mysql -u root -p
```
MySQLコンテナに入る
```
$ docker rm <コンテナID>
```
コンテナの削除
```
$ docker rmi <イメージID>
```
イメージの削除