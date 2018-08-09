SHA=$(git rev-parse --verify HEAD)
echo Logging into AWS
$(aws ecr get-login --no-include-email --region us-east-1 --profile posadera)

echo Building NGINX
REPOSITORY_URL=456990568530.dkr.ecr.us-east-1.amazonaws.com/posadero-nginx
docker build -t $REPOSITORY_URL:$SHA -t $REPOSITORY_URL:latest -f DockerfileNginx .
docker push $REPOSITORY_URL

echo Building APP
REPOSITORY_URL=456990568530.dkr.ecr.us-east-1.amazonaws.com/posadero-web
docker build -t $REPOSITORY_URL:$SHA -t $REPOSITORY_URL:latest -f DockerfileApp .
docker push $REPOSITORY_URL

echo Deploying
kubectl set image deployment/posadero posadero=456990568530.dkr.ecr.us-east-1.amazonaws.com/posadero-nginx:$SHA -n posadero-prod
kubectl set image deployment/posadero posadero=456990568530.dkr.ecr.us-east-1.amazonaws.com/posadero-web:$SHA -n posadero-prod
