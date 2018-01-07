#Create a New Website With Symfony 4

### Requirements

1. Php must be installed on the machine.

    http://windows.php.net/
    https://www.apachefriends.org/ 
	www.wampserver.com/en/
	
1. Composer must be installed on the machine.

    https://getcomposer.org/Composer-Setup.exe
	
1. Git must be installed on the machine.
	
    https://git-scm.com/download
	
### Booting Up

1. Create Project Skeleton

    ```bash
    $ composer create-project symfony/skeleton sfskeleton
    ```
		
1. Require Important Packages

    ```bash
    $ compose$r require server --dev (optional)
    $ composer require annotations
    $ composer require twig
    $ composer require --dev profiler
    $ composer require assets
    ```

1. Start Server 

    ```bash
    php bin/console server:run
    ```
		
1. Some Configuration
	
    Enable Sessions by opening `config/packages/framework.yaml` and uncomment the following block:
    
    ```yaml
        # uncomment this entire section to enable sessions
        session:
            # With this config, PHP's native session handling is used
            handler_id: ~
    ```
		
1. Create a controller that returns a request: 
	
	```php
	<?php
    //File: src/Controller/HomeController.php
   
    namespace App\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    
    class HomeController extends AbstractController
    {
        /**
         * @Route("/")
         * @param Request $request
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function homePage(Request $request)
        {
            return $this->render('digital-cash/home.html.twig');
        }
    }
	```
	
1. Create a twig template
	
	```twig
    {% extends 'base.html.twig' %}
    
    {% block title %}Home {{ parent() }}{% endblock %}
    
    {% block pageTitle %}Welcome to Digital Cash @ YourWeb.Agency{% endblock %}
    {% block sectionPageBody %}
        <p>We are here to cover all things crypto-currency related! </p>
    {% endblock %}
    ```
	
1. Update/add .gitignore
    
    ```git
    ### IDE & OS
    .idea/
    
    ###> symfony/framework-bundle ###
    .env
    /public/bundles/
    /var/
    /vendor/
    ###< symfony/framework-bundle ###
    
    ###> symfony/web-server-bundle ###
    .web-server-pid
    ###< symfony/web-server-bundle ###
    ```
    
1. Create git repository

1. Add Repository Remote, commit work, push project

    ```bash
    $ git remote add origin git@bitbucket.org:laytoneverson/digitalcash.yourweb.agency.git
    $ git add --all
    $ git push -u origin master
    ```
