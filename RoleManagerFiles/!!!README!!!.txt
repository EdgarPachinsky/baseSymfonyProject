/**** AUTHOR -> EDGAR PACHINSKY , TOOLBOXSOFTWARE ***/
!!  This file assumes you are using Symfony 3.x.x, with SonataAdminBundle !!
!!  and FOSUserBundle !!


1) Watch  security.yml.dist  file , and modify
	role_hierarchy:
	     ....
	access_control:
	     ....
   lines like in that file , do not pay attention on ROLE_YOUR_ROLE , this is for 
   exaple

   !! Modify this file very careful , any mistake can cause unwanted effects !!

2) Copy all files from Admin dir to your project src->YourBundle->Admin
3) Copy all files from Entity dir to your project src->YourBundle->Entity 
   and Translations also
   !! If You Already Modified User.php just add this 2 lines and getter , setter
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\UserRoles")
     */
    protected $adminAccessRoles;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $roleChange = 0;   

4) Copy UserBundle dir to your project src, then register bundle in AppKernel
	new UserBundle\UserBundle(),
5) Copy all files from Controller to your project src->YourBundle->Controller
6) Put this lines in app->Resources->SonataAdminBundle->views->layout.html.twig
   in {% block javascripts %}

    {% if app.user is not null %}
        {% if app.user.roleChange == 1 %}
            <script>window.location.href = '/'</script>
        {% endif %}
    {% endif %}
7) do php bin/console doctrine:schema:update --force , update database

Enjoy Dynamic Role System :)