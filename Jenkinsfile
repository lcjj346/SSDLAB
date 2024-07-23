pipeline {
    agent any

    environment {
        DEPENDENCY_CHECK_CMD = 'dependency-check --noupdate'
        UI_TEST_CMD = 'curl -s -o /dev/null -w "%{http_code}" http://webapp'
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'master', url: 'https://github.com/your-repo/webapp'
            }
        }

        stage('Build') {
            steps {
                script {
                    sh 'docker-compose -f docker-compose.yml up -d --build'
                }
            }
        }

        stage('Dependency Check') {
            steps {
                script {
                    sh "${DEPENDENCY_CHECK_CMD}"
                }
            }
        }

        stage('Integration Test') {
            steps {
                script {
                    sh "${UI_TEST_CMD}"
                }
            }
        }

        stage('Teardown') {
            steps {
                script {
                    sh 'docker-compose -f docker-compose.yml down'
                }
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: '**/target/*.jar', allowEmptyArchive: true
            junit '**/target/test-classes/testng-results.xml'
        }

        success {
            echo 'Pipeline completed successfully.'
        }

        failure {
            echo 'Pipeline failed.'
        }
    }
}
