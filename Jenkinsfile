
pipeline {
     agent any
     environment {
        DOCKERHUB_CREDENTIALS=credentials('dockerhub-cred-acapvevo')
    }
    stages {
        stage('Build') {
            steps {
                echo 'Building...'
                sh 'docker build -t acapvevo/utmdte_api:latest .'
            }
            post {
                always {
                    jiraSendBuildInfo branch: 'master', site: 'dasani.atlassian.net'
                }
            }
        }
        stage('Login') {
            steps {
                sh 'echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin'
            }
        }
        stage('Push') {
            steps {
                sh 'docker push acapvevo/utmdte_api:latest'
            }
        }
        stage('Deploy - Production') {
            when {
                branch 'master'
            }
            steps {
                echo 'Deploying to Production from master...'
            }
            post {
                always {
                    jiraSendDeploymentInfo environmentId: '', environmentName: '', environmentType: 'development', issueKeys: [''], serviceIds: [''], site: 'dasani.atlassian.net', state: 'unknown'
                }
            }
        }
    }
    post {
		always {
			sh 'docker logout'
		}
	}
}
