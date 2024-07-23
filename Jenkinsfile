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
		stage('Code Quality Check via SonarQube') {
			steps {
				script {
				def scannerHome = tool 'SonarQube';
					withSonarQubeEnv('SonarQube') {
					sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=OWASP - Dsonar.sources=."
					}
				}
			}
		}
	}
		post {
			always {
				recordIssues enabledForFailure: true, tool: sonarQube()
				}
			}
    	}
    post {
        always {
            archiveArtifacts artifacts: '**/target/*.html', allowEmptyArchive: true
            junit 'target/test-*.xml'
        }
    }

