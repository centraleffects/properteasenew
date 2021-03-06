<?php
/**
 * @package Freestyle Joomla
 * @author Freestyle Joomla
 * @copyright (C) 2013 Freestyle Joomla
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

require_once (JPATH_SITE.DS.'components'.DS.'com_fss'.DS.'helper'.DS.'tickethelper.php');

class FSSParser
{
	var $template = "";
	var $vars = array();

	var $loadedtmpl;
	var $loadedtype;
	
	function Load($template, $tpltype)
	{
		//echo "Loading $template => $tpltype<br>";
		if ($this->loadedtmpl == $template && $this->loadedtype == $tpltype)
			return;
		$db = JFactory::getDBO();
		$query = "SELECT * FROM #__fss_templates WHERE template = '" . FSSJ3Helper::getEscaped($db, $template) . "' AND tpltype = " . FSSJ3Helper::getEscaped($db, $tpltype);
		$db->SetQuery($query);
		$tmpl = $db->LoadObject();
		$this->template = $tmpl->value;
		$this->ProcessLanguage();
		
		$this->loadedtmpl = $template;
		$this->loadedtype = $tpltype;
	}	

	function SetTemplate($tmpl)
	{
		$this->template = $tmpl;
	}
	
	function ProcessLanguage()
	{
		$text = $this->template;
		if (preg_match_all("/\%([A-Za-z_]+)\%/", $text, $matches))
		{
			foreach($matches[1] as $match)
			{
				$find = "%" . $match . "%";
				$replace = JText::_($match);

				$text = str_replace($find, $replace, $text);
			}
			
			$this->template = $text;
		}
	}
	
	function Clear()
	{
		$this->vars = array();	
	}

	function SetVar($var, $value)
	{
		$this->vars[$var] = $value;
	}

	function GetVar($var)
	{
		return $this->vars[$var];
	}

	function AddVars(&$vars)
	{
		foreach($vars as $var => $value)
			$this->vars[$var] = $value;
	}

	function Parse()
	{
		//echo "<pre>";
		//print_r($this->vars);
		//echo "</pre>";
		$t = $this->template;
		//echo "Parsing : <pre>" . htmlentities($t) . "</pre><br>";
		$o = $this->ParseInt($t);

		//echo "Result : <pre>" . htmlentities($o) . "</pre><br>";
		//exit;
		return $o;
	}

	function ParseInt($t)
	{
		$max = 0;
		$o = "";
		$toffset = 0;
		
		while (strpos($t,"{",$toffset) !== false && $max < 1000)
		{
			$start = strpos($t,"{",$toffset)+1;	
			$end = strpos($t,"}",$start);
			$tag = substr($t,$start,$end-$start);
			$max++;

			$bits = explode(",",$tag);
			//echo "Tag : " . $bits[0] . "<br>";

			$o .= substr($t,$toffset,$start-$toffset-1);
			$toffset = $end + 1;

			if ($bits[0] == "if" || $bits[0] == "endif")
			{
				//echo "Processing IF <br>";

				// find the endif. Allows nested if statements
				$open = 1;
				$ifstart = $toffset;
				while (strpos($t,"{",$toffset !== false) && $open > 0)
				{
					$start = strpos($t,"{",$toffset)+1;	
					$end = strpos($t,"}",$start);
					$tag = substr($t,$start,$end-$start);

					$bits2 = explode(",",$tag);
					if ($bits2[0] == "if")
					{
						$open ++;	
					} else if ($bits2[0] == "endif")
					{
						$open--;	
					}
					$toffset = $end + 1;
					//echo "If tag $tag, depth = $open<br>";
				}
				$ifend = $toffset;
				$ifcode = substr($t,$ifstart,$ifend-$ifstart-7);

				//echo "IF Code : <pre>" . htmlentities($ifcode) . "</pre><br>";

				// match the if
				$matched = false;
				//echo "If: " . print_r($bits, true) . " - ";
				//echo $this->vars[$bits[1]] . " - ";
				if (count($bits) == 2)
				{
					$var = $bits[1];

					if (array_key_exists($var,$this->vars))
					{
						$value = $this->vars[$var];
						if ($value)
							$matched = true;
					}
				} else if (count($bits) == 3)
				{
					$var = $bits[1];
					$value = trim($bits[2],"\"'");	
					
					if (array_key_exists($var,$this->vars))
					{
						$varvalue = $this->vars[$var];
						if ($varvalue == $value)
							$matched = true;
					}
				} else if (count($bits) == 4)
				{
					$var = $bits[1];
					$value = trim($bits[2],"\"'");	
					$op = $bits[3];
					if (array_key_exists($var,$this->vars))
					{
						$varvalue = $this->vars[$var];
						if ($op == "not")
						{
							if ($varvalue != $value)
								$matched = true;
						} else {
							if ($varvalue == $value)
								$matched = true;
						}
					}
				}

				/*if ($matched)
					echo "TRUE";
				else 
					echo "FALSE";

				echo "<br>";*/
				// if IF statement is matched, parse the insides of it
				if ($matched)
					$o .= $this->ParseInt($ifcode);
			} else if ($bits[0] == "set")
			{
				if (count($bits) == 3)
				{
					$var = $bits[1];
					$value = $bits[2];
					if (is_numeric($value))
					{
						$this->vars[$var] = $value;	
					} else if ( 
							(substr($value,0,1) == "\"" || substr($value,0,1) == "'") &&
							(substr($value,strlen($value)-1,1) == "\"" || substr($value,strlen($value)-1,1) == "'"))
					{
						$this->vars[$var] = trim($value,"\"'");	
					} else if (array_key_exists($value,$this->vars))
					{
						$this->vars[$var] = $this->vars[$value];
					} else {
						$this->vars[$var] = $value;	
					}
					//echo "Setting $var to {$this->vars[$var]}<br>";
				}
			} else {
				if (array_key_exists($bits[0],$this->vars))
				{
					if (isset($bits[1]) && $bits[1] > 0)
					{
						$ending = "";
						if (isset($bits[2])) $ending = $bits[2];
						$is_trimmed = false;
						$o .= FSS_Helper::truncate($this->vars[$bits[0]], $bits[1], $is_trimmed, $ending);
					} else {
						$o .= $this->vars[$bits[0]];
					}
				}	
			}
		}

		$o .= substr($t,$toffset);

		if ($max == 1000)
			exit;
		
		return $o;
	}

}