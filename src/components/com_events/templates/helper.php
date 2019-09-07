<?php 

class ComEventsTemplateHelper extends LibBaseTemplateHelperAbstract
{
	public function dates($event)
	{
		$startDate = new DateTime($event->startDate->getDate(DATE_FORMAT_ISO));
		$endDate = new DateTime($event->endDate->getDate(DATE_FORMAT_ISO));
		$string = '';

		$string .= $startDate->format('F j');

		// $string .= '<sup>' . $startDate->format('S') . '</sup>';

		$multiDayEvent = $startDate->format('j') != $endDate->format('j');

		// if it ends on another day
		if($multiDayEvent) {

			// if it ends in another year
			if($startDate->format('Y') != $endDate->format('Y')) {
				$string .= ', ';
				$string .= $startDate->format('Y');
			}

			$string .= ' - ';

			// and the end date is in another month
			if($startDate->format('n') != $endDate->format('n')) {
				$string .= $endDate->format('F');
			}

			$string .= ' ';

			$string .= $endDate->format('j');
			// $string .= '<sup>' . $endDate->format('S') . '</sup>';
		}

		$string .= ', ';
		$string .= $endDate->format('Y');

		if (!$multiDayEvent) {
			// add the start time
			$string .= $startDate->format(' g:i A');
		}

		return $string;
	}

	public function date($event) {
		$startDate = new DateTime($event->startDate->getDate(DATE_FORMAT_ISO));
		$date = '';

		$date .= $startDate->format('F j');
		$date .= $startDate->format('S');
		$date .= $startDate->format(', g:i a');
		$date .= ' UTC';
		return $date;
	}

	// https://gist.github.com/mrkmg/1607621
	public function stringToColor($text, $minBrightness = 25, $spec = 2) {
		$hash = md5($text);  //Gen hash of text
		$colors = array(); 
		for($i=0;$i<3;$i++)
			$colors[$i] = max(array(round(((hexdec(substr($hash,$spec*$i,$spec)))/hexdec(str_pad('',$spec,'F')))*255),$minBrightness)); //convert hash into 3 decimal values between 0 and 255
			
		if($minBrightness > 0)  //only check brightness requirements if minBrightness is about 100
			while( array_sum($colors)/3 < $minBrightness )  //loop until brightness is above or equal to minBrightness
				for($i=0;$i<3;$i++)
					$colors[$i] += 10;	//increase each color by 10
					
		$output = '';
		
		for($i=0;$i<3;$i++)
			$output .= str_pad(dechex($colors[$i]),2,0,STR_PAD_LEFT);  //convert each color to hex and append to output
		
		return '#'.$output;
	}

}