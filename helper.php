<?php

  /* 
  * Twitter-like Hashtag system with Unicode and Hashtag Exporting system Support 
  *
  * @author RezaSeyf <reza.safe@icloud.com>
  * @license http://opensource.org/licenses/gpl-license.php GNU Public License
  * github: https://github.com/RezaSeyf
  * blog  : http://1reza.blogspot.com
  
  
  * Export the hashtags of a given string 
  *
  * @param string $str         
  * the input string to be proccess and export the hashtags from it
  *
  * @param string $outputType  
  * using 'null' as default will output the full text with href'ed links for hashtags or 'tagsOnly' to just show the hashtags
  *
  * @return string Returns the full string with linked hashtags or will just give you the hashtags.
  */
  
function tagExport($str ,$outputType = null) 
{ 
  
  /** 
  * @var hashtagsArray[] 
  * An array of string objects for storing hashtags inside it. 
  */ 
	$hashtagsArray = array(); 
	
  /** 
   *
   * @var strArray[] 
   * An array of string objects that will save the words of the string argument.  
   *
   */  
   $strArray = explode(" ",$str);
	
   /** 
   *
   * @var string $pattern
   * regular expression pattern for notes  
   * don't scare! it works! even with unicode characters!
   */  
   $pattern = '%(\A#(\w|(\p{L}\p{M}?)|-)+\b)|((?<=\s)#(\w|(\p{L}\p{M}?)|-)+\b)|((?<=\[)#.+?(?=\]))%u'; 
	
	 
   	foreach ($strArray as $b) 
	{  
		  // match the word with our hashtag pattern
	   	  preg_match_all($pattern, ($b), $matches);
	   	  
	   	  /** 
		   *
		   * @var hashtag[] 
		   * An array of string objects that will save the hashtags.
		   *
		   */ 
		  $hashtag	= implode(', ', $matches[0]);   
		  
		  // add to array if hashtag is not empty
		  if (!empty($hashtag) or $hashtag != "")
		  	array_push($hashtagsArray, $hashtag); 
	}
	
	// now we have found all hashtags in the string
	// so we have to replace them and built a new string :
	foreach ($hashtagsArray as $c)
	{
		/** 
	    *
	    * @var string $hashtagTitle
	    * container for the exported hashtags without # sign (to insert to db or etc) 
	    */ 
		$hashtagTitle = ltrim($c,"#");
		
		//create links for hashtags
		$str = str_replace($c,'<a href="?lookfor='.$hashtagTitle.'">#'.$hashtagTitle.'</a>',$str);
		
		// uncomment the below line to see the functionality.
		// echo "$hashtagTitle <br>";
	} 
	
	// return fulltext with linked hashtags OR return just the hashtags (with # sign)
	if ($outputType == "tagsOnly") 
		return $listOfHashtags = implode(" ",$hashtagsArray);  
	else
		return $str;  
	
}
