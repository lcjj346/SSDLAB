pipeline {
  environment {
    registry = "bkshashi9/webapp"
    registryCredential = 'dockerhub'
    dockerImage = ''
  }
  agent any
  stages {
    stage('Cloning Git') {
      steps {
        git 'ssh://git@54.90.171.99:2222/git-server/repos/webapp.git'
      }
    }
    stage('Building Docker Image') {
      steps{
        script {
          dockerImage = docker.build registry + ":$BUILD_NUMBER"
          
        }
      }
    }
    stage('Push Image to Docker Hub ') {
      steps{
        script {
          docker.withRegistry( '', registryCredential ) {
            dockerImage.push()
            dockerImage.push('latest')
          }
        }
      }
    }
  
def remote = [:]
remote.name = "ubuntu"
remote.host = "54.158.145.132:22"
remote.allowAnyHosts = true

        stage("Latest Docker Image Deploy") {
            
            sshCommand remote: remote, command: 'docker pull bkshashi9/webapp:latest 
                      docker stop webapp
                      docker rm webapp  
                      docker rmi bkshashi9/webapp:current
                      docker tag bkshashi9/webapp:latest bkshashi9/webapp:current  
                      docker run -d --name webapp -p 8082:80 bkshashi9/webapp:latest'
          
        }

 
  }
}
