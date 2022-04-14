Movie app README

  -Copy source code into folder with given directory structure.
  -Have your xampp server running
  -Copy PHPandSQL folder into the proper directory for xampp: /xampp/htdocs/
  -name the database movie
  -Run "source movie.sql" to create and populate the tables with the relevant information if you already have movie database created
  -run android studio and open the existing project from the code provided (The java source code is located at "Movie_app/Movies/app/src/main/java/com/example/movies")
  -Find and select the App/Movies directory and click OK to open the project
  -In res/values/strings.xml in Android Studio, you must change "url" to the directory containing the PHP files
  -Get the ip address for your server. If using windows,you can find it in the netstat section of the xampp controller,  should be something like "http://999.999.9.9:80/"
  -Setup a device simulator to run the app in Android Studio.
  -Run the app using the Run app button near the top of the Android Studio window.
