pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/lcjj346/SSDLAB.git'
            }
        }
        stage('OWASP Dependency-Check Vulnerabilities') {
            steps {
                dependencyCheck additionalArguments: '''
                    -o './'
                    -s './'
                    -f 'ALL'
                    --prettyPrint
                ''', odcInstallation: 'OWASP Dependency-Check Vulnerabilities'

                dependencyCheckPublisher pattern: 'dependency-check-report.xml'
            }
        }
        stage('Integration Testing') {
            steps {
                echo 'Running integration tests...'
                
            }
        }
        stage('UI Testing') {
            steps {
                echo 'Running UI tests...'
                
            }
        }
    }
    post {
        always {
            archiveArtifacts artifacts: '**/target/*.html', allowEmptyArchive: true
            junit 'target/test-*.xml'
        }
    }
}
