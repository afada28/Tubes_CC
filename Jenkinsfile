pipeline {
    agent any
    
    environment {
        // Azure Configuration - Sesuaikan dengan konfigurasi Anda
        AZURE_RESOURCE_GROUP = 'your-resource-group'
        AZURE_APP_SERVICE = 'your-app-service-name'
        
        // PHP Configuration
        PHP_VERSION = '8.1'
    }
    
    stages {
        stage('Checkout') {
            steps {
                echo 'Checking out source code...'
                checkout scm
            }
        }
        
        stage('Install PHP Dependencies') {
            steps {
                echo 'Installing Composer dependencies...'
                bat '''
                    composer install --no-dev --optimize-autoloader --no-interaction
                '''
            }
        }
        
        stage('Install Node Dependencies') {
            steps {
                echo 'Installing NPM dependencies...'
                bat '''
                    npm ci
                '''
            }
        }
        
        stage('Build Assets') {
            steps {
                echo 'Building frontend assets with Vite...'
                bat '''
                    npm run build
                '''
            }
        }
        
        stage('Setup Environment') {
            steps {
                echo 'Setting up environment file...'
                bat '''
                    if not exist .env copy .env.example .env
                    php artisan key:generate --force
                '''
            }
        }
        
        stage('Run Tests') {
            steps {
                echo 'Running PHPUnit tests...'
                bat '''
                    php artisan test --no-coverage
                '''
            }
        }
        
        stage('Prepare for Deployment') {
            steps {
                echo 'Preparing application for deployment...'
                bat '''
                    php artisan config:cache
                    php artisan route:cache
                    php artisan view:cache
                '''
            }
        }
        
        stage('Deploy to Azure') {
            steps {
                echo 'Deploying to Azure App Service...'
                withCredentials([azureServicePrincipal('azure-service-principal')]) {
                    bat '''
                        az login --service-principal -u %AZURE_CLIENT_ID% -p %AZURE_CLIENT_SECRET% --tenant %AZURE_TENANT_ID%
                        az webapp deployment source config-zip --resource-group %AZURE_RESOURCE_GROUP% --name %AZURE_APP_SERVICE% --src deployment.zip
                    '''
                }
            }
        }
    }
    
    post {
        always {
            echo 'Cleaning up workspace...'
            cleanWs()
        }
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed. Check the logs for details.'
        }
    }
}
