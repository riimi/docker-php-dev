# docker-php-dev

docker 컨테이터를 이용하여 빠르게 php 테스트 환경을 구축하고 배포하는 연습을 하기 위한 데모용 저장소입니다.

## 준비

docker가 설치되어 있어야 합니다

## 데모 실행하기

docker swarm 시작

    docker swarm --init
   
프라이빗 docker 이미지 저장소 실행

    docker service create --name registry -p 5000:5000 registry:2

php-fpm 커스텀 이미지 굽기

    docker build . -t localhost:5000/myphp 

커스텀 이미지를 저장소로 업로드

    docker push localhost:5000/myphp

WAS, DB, Memory Cache, Scribe Server 배포!

    docker stack deploy -c compose.yml prometheus

## Scale Out

현재 서비스 목록 확인

    docker service ls
    
php-fpm 인스턴스 hostname 확인

    curl localhost:8080/index.php
    # {"hostname":"31c5c71ae39b", ...
    
php-fpm 인스턴스 수를 1->5개로 scale out

    docker service scale demo_php=5
    
nginx 프록시 리로드

     docker exec $(docker ps -f 'name=demo_nginx*' -q) /etc/init.d/nginx reload
     
php-fpm 인스턴스 hostname 확인 (매 요청시 hostname이 바뀜) 
    
    curl localhost:8080/index.php
    # {"hostname":"31c5c71ae39b", ...
    
## Rolling Update

`./app` 코드 수정 후 php-fpm 커스텀 이미지 굽기

    docker build . -t localhost:5000/myphp:2
    
커스텀 이미지를 저장소로 업로드

    docker push localhost:5000/myphp
    
업데이트

    docker service update --image localhost:5000/myphp:2 demo_php
    
 ## Clean Up
 
    docker stack rm demo
    docker swarm leave --force