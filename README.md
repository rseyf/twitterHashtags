#twitterHashtags
- This is a helper function with unicode support to export the hashtags that exists in a string.

 Example:  
 $sometext = "I'm a #Persian #Programmer. \n My native language is #فارسی";      <br>
 echo tagExport($sometext); 
 
 
 Output:
 
 I'm a <a href="?lookfor=Persian">#Persian</a> <a href="?lookfor=Programmer">#Programmer</a>. <br> My native language is <a href="?lookfor=فارسی">#فارسی</a>
