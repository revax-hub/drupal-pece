Administering PECE
==================

How do I install PECE?
----------------------

PECE is a Free Software-based Drupal distribution, therefore the
[*standard installation procedure for Drupal 8*](https://www.drupal.org/requirements) applies to PECE with a few
extra dependencies.

The following instructions have been tested on a Debian 8 (jessie)
server, but they are not OS-dependent. PECE should run on any system
supported by Drupal 8. PECE has been tested in virtual machines with
256M allocated for PHP, being 128M the recommended minimum for Drupal 8
distributions. Your configuration, of course, may vary considerably
depending on the usage you are making of the platform. Refer to our data
management guidelines under the “sustainability” section to learn about
the recommended minimum specs for your servers.

### Downloading the Distro

Our distribution is currently being developed on Github. You can obtain
the most updated version following the link “Releases” on the project’s
git repository:

> https://github.com/PECE-project/pece-distro

Alternatively, you can obtain the source code and build the distro
yourself if you intend to help our team by fixing bugs and extending the
platform for your research purposes:

> git clone
> https://github.com/PECE-project/drupal-pece.git

If you are a developer who wants to contribute to PECE, you will need to
follow special instructions to install and configure the tools for
building the distro. Consult the sub-section [*Setting up the Development Environment*](http://pece.readthedocs.io/en/latest/installation.html#setting-up-the-development-environment)
below for more information.

### Dependencies

PECE has extra dependencies in addition to the ones you will need:

- Docker
- Docker Compose
- Make
- Composer

### Quick Install

## Usage

1- Install Docker

2- Install docker-compose

3- Rename .env.example to .env and if necessary, change the variables.
Ex.: ```PROJECT_BASE_URL=yoururl.com```

4- Run command `make up`

5- Try access http://yoururl.com to finish installation or use ```make si pece``` in the command line

Look docker.mk to see others make commands and read .env about database settings

How to use the docker compose override
---------------------------------------------------------
Docker compose override allows you to change and add new settings and services in your container.

Copy docker-compose.override.yml.example to docker-compose.override.yml and change the values as desired, for example, 
add user and password to nginx for a stage environment.

- User: test
- Pass: test

Created using http://www.htaccesstools.com/htpasswd-generator/
```yaml
  nginx:
    labels:
      - 'traefik.logs.frontend.auth.basic.users=test:$$apr1$$n4tqay70$$Y6K.H9JYEhofKykkT'
```

About docker override: https://docs.docker.com/compose/extends/

About docker 4 Drupal: https://wodby.com/docs/stacks/drupal/local/#usage


I’ve installed PECE, but none of my links are working. What is going on?
------------------------------------------------------------------------

Your webserver is not properly configured to support what is called
“Clean URLs” on Drupal. Make sure you have your httpd “rewrite” rules
properly set-up. This configuration can be done in the vhost file of
your nginx configuration, following the [*Perusio guide*](https://github.com/perusio/drupal-with-nginx) or using the [*default.htaccess file that is provided by default by Drupal*](https://github.com/PECE-project/drupal/blob/7.x/.htaccess) if you are running Apache.

When should the admin log-in credentials be used?
-------------------------------------------------

Distribute admin log-in credentials to as few users as possible. Admin
log-in credentials should only be used to configure settings and to
approve new users. The admin credentials should not be used to add
content or comment on content.

How do I update the site information?
-------------------------------------

Go to “Administration » Configuration » System » Site information” and
fill out the information about your site name, the basic admin password,
contact, timezone and other relevant info.

How do I add a logo and change site colors?
-------------------------------------------

Go to “Administration » Appearance » Settings » PECE Scholarly Lite.
Under the heading, Logo image settings, uncheck the box to use the
default logo. Choose a file to upload as the logo. To change site
colors, scroll down on this page to the heading “MtT Settings.” Click
the “Look’n’Feel” link. Check the box to use a Custom Color Scheme.
Select a Primary color (header and icons), Secondary color (links), and
Tertiary color (color to appear on hover in main navigation). Click
“Save Configuration.”

How do I upload the terms of service?
-------------------------------------

Go to “Administration » Configuration » People » Legal” and click “Add
T&C”, then fill-out the boxes with your custom text to be displayed to
every user who requests an account on the system. You may ask: why is
there not a default “Terms of Service”? Because... the text really
depends on the way you are using PECE, so our legal documents won’t not
suit your case, you need to craft your own text according to the usage
you are making of PECE. We are not (cannot and should not be)
responsible for any use authorized researchers or any other person make
of the platform. Please, refer to our section on “Legal Documents” for
more information about the software licenses we use for the PECE project
(and for the Free Software technology we use from the Drupal project).

How do I configure AES?
-----------------------

To config AES, go to: “Administration » Configuration » System » AES
settings”. Make sure to point to a secure directory outside the webroot
where PECE is installed to store your key and make it read-only (to the
owner of the httpd service), instead of having it stored in the database
(which tends to be a much less secure option).

How do I configure Amber to archive links on the platform?
----------------------------------------------------------

PECE comes pre-shipped with Amber, so if you have an account on Perma.cc
you can set PECE up to use it an store your snapshots there. This is the
way to go when it comes to long-term preservation of content for
scholarly purposes. Go to “Administration » Configuration » Content
authoring » Amber” and select “perma.cc” as alternate backend and
provide your API key in the text field below. Done! You are storing
“PECE Website” link artifacts, hopefully, for many future
anthropological lives and times now.

How do I set up back-ups?
-------------------------

As explained in our data management guidelines, PECE is configured to
automatically generate backups. You should, however, revise the settings
and set-up a SFTP connection to transfer your backup to another server
and ensure that you have extra security when storing your encrypted
backups. First, revise the settings we provided, changing whatever you
think is needed (say, the most convenient time, when the site is not
being used, to generate the backup). Go to “Configuration » System »
Backup and Migrate” to perform this first step. Then, click on
“Destinations” and “Add Destination” to set-up the SFTP connection with
the credentials of your backup server. Please note that you have to use
the port 22 (not 21) and password authentication, since ssh-key
authentication is unfortunately not supported yet.

How do I configure SMTP so that emails can be sent from the platform?
---------------------------------------------------------------------

PECE uses Drupal notification for key events on the system. It has to be
configured using a regular email address, provided you have all the mail
server information. You just need your SMTP server info and credentials
to get this done. Go to “Administration » Configuration » System » SMTP
Authentication Support” and provide your SMTP server information,
including username and password.

How do I configure Zotero?
--------------------------

Navigate to /admin/modules, and turn on modules the Feed Admin UI and
Feeds Importer. Flush all caches. Navigate to
admin/structure/feeds/zotero\_feed. To the right under, Zotero Process,
select Settings to configure the Zotero Importer module. Most settings
here can remain the same. However, we encourage you to:

-   Under “Update Existing Nodes,” change “Do Not Update Existing Nodes” to “Update Existing Nodes.” This way if you update an entry in Zotero, it will also be updated in the platform on the next feed import

-   Under “Sync zotero tags to a term reference field in the biblio content type?” change “yes” to “no.” Often Zotero entries are added to the library with chaotic tagging schemes. Checking “no” here will ensure those schemas don’t get added to the PECE tag library.

-   Save.

How do I approve user memberships?
----------------------------------

While logged-in as an administrator, navigate to /admin/people. Select
‘edit’ next to the user you wish to approve. Change the user status to
‘Active’ and select the appropriate [*User Roles*](#user-roles). Click
the ‘Save’ button at the bottom of the page.

How do I add front page image sliders?
--------------------------------------

While logged-in as an administrator, navigate to ‘Dashboard’. Under the
‘Add Content’ heading, select front page slider. Fill in the relevant
fields and Save. Note that all images will be scaled and cropped to
960x460 pixels.

How do I increase the file upload limit?
----------------------------------------

While logged-in as an administrator, navigate to Administration &gt;&gt;
Configuration &gt;&gt; Media &gt;&gt; File Settings. Under the Maximum
Upload Size field, enter a new value (we use 2GB). Click Save
Configuration. You may also need to increase the upload limit on the
server.

How do I update the platform when a new instance of distro is released?
-----------------------------------------------------------------------

Always back-up your files and database before updating the platform.

Put the site in maintenance mode. Under sites/default/, there is a file
called settings.php. Search for \$update\_free\_access = FALSE; and
change FALSE to TRUE.

Then, go to YourSite/update.php and follow the steps. In theory major
updates are not handled differently, but sometimes issues have occurred.

Be sure to turn off maintenance mode when you are done.

Other Post-Installation Troubleshooting
---------------------------------------

-   “Time Out” during installation: this issue is related to the usage of Drupal distributions in “shared hosting” environments which are very limited in terms of the resources allocated per client / user account. If the installation process is interrupted before it is finished, you will have to check your PHP configuration and increase the memory allocation and timeout configuration for the php scripts with the following directives: memory\_limit and max\_execution\_time which can be found in your php.ini file. After doing so, you should not experience more “timeouts” during installation.

-   Links do not work: your webserver is not properly configured to support what is called “Clean URLs” on Drupal. Make sure you have your httpd “rewrite” rules properly set-up. This configuration can be done in the vhost file of your nginx configuration, following the [*Perusio guide*](https://github.com/perusio/drupal-with-nginx) or using the [*default.htaccess file that is provided by default by Drupal*](https://github.com/PECE-project/drupal/blob/7.x/.htaccess) if you are running Apache.

-   Permission denied when uploading content: your filesystem permissions must be set accordingly for the public and private directories, since PECE uses both extensively. [*Follow this official Drupal tutorial*](https://www.drupal.org/node/244924) to configure the permissions properly for both directories where you installed PECE.

-   Permission denied when uploading content after configuring filesystem permissions: make sure your /tmp is also writable and, if you are on a shared host and cannot have access to it, configure Drupal to point to a temporary directory in your system/files path. There is a [*discussion about this issue on Drupal.org that is helpful*](https://www.drupal.org/node/2140629).

-   Cannot create users, server internal error: in our experience, php5-mcrypt is probably not installed in your system. Make sure it is properly installed and loaded, by running php -m in a shell and checking if it is listed.
