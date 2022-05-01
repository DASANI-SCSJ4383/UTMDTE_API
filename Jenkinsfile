pipeline {
     agent any
     stages {
         stage('Build') {
             steps {
                 echo 'Building...'
             }
             post {
                 always {
                     jiraSendBuildInfo branch: 'master', site: 'dasani.atlassian.net'
                 }
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
 }

