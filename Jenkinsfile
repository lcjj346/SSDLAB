pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/lcjj346/SSDLAB.git'
            }
        }
        stage('Dependency Check') {
            steps {
                sh 'dependency-check --noupdate --scan ./webapp'
            }
        }
        stage('Integration Testing') {
            steps {
                // Add commands for integration testing
                sh 'php ./webapp/tests/integration_tests.php'
            }
        }
        stage('UI Testing') {
            steps {
                // Add commands for UI testing
                sh 'php ./webapp/tests/ui_tests.php'
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
