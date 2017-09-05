=INSTALL=

-WINDOWS-

1. Drop the 'cg' folder into your project folder

2. Go to your database (MySQL) and create a database called 'cg'

3. Import the 'cg.sql' into your 'cg' database

4. Go to your 'index.php' file and add :

  

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  
	<script type="text/javascript" src="cg/distr.js"></script>



5. Finally go '/filepath to your project/cg/signup.php' and create your admin account, be sure to delete this file once you don't need anymore administrators

-LINUX-

- Follow all the Windows steps but alter your project's permissions, so Content Goblin can upload pictures into the 'uploads' folder�

-MAC-

- I don't know, I don't own one, figure it out on your own...
- Tip: follow the basic Windows instructions

=FILES=

- All of your uploaded files are located in '/cg/uploads'
