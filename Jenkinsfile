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
        git 'ssh://git@54.158.145.132:2222/git-server/repos/webapp.git'
      }
    }
    stage('Building Docker image') {
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
            
            sshCommand remote: remote, command: "docker pull bkshashi9/webapp:latest "
            sshCommand remote: remote, command: "docker stop webapp "
            sshCommand remote: remote, command: "docker rm webapp "
            sshCommand remote: remote, command: "docker rmi bkshashi9/webapp:current"
            sshCommand remote: remote, command: "docker tag bkshashi9/webapp:latest bkshashi9/webapp:current"
            sshCommand remote: remote, command: "docker run -d --name webapp -p 8082:80 bkshashi9/webapp:latest"                       
                                
          
        }
    }

   
  }
}

