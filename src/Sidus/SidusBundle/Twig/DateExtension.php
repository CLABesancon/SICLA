<?php
namespace Sidus\SidusBundle\Twig;

class DateExtension extends \Twig_Extension{
    
    public function getName() {
        return 'sidus_date';
    }
    
    public function getFilters(){
        return array(
            'datediff'=>new \Twig_Filter_Method($this,'datediff'),
        );
    }
    
    public function datediff(\DateTime $date,$date_origin = ''){
        if ($date_origin == '' or $date_origin === null){
            $date_origin = new \DateTime('now');
        }
        $interval = $date->diff($date_origin);
        
        //return $interval->format('s:%s m:%i h:%h d:%d M:%m y:%y');
        
		if($interval->y == 0){
			if($interval->m == 0){
				if($interval->d == 0){
					if($interval->h == 0){
						if($interval->i == 0){
							if($interval->s == 1){
								return $interval->format('%s second ago');
							}else{
								return $interval->format('%s seconds ago');
							}
						}elseif($interval->i == 1){
							return $interval->format('%i minute ago');
						}else{
							return $interval->format('%i minutes ago');
						}
					}elseif($interval->h == 1){
						return $interval->format('%h hour ago');
					}else{
						return $interval->format('%h hours ago');
					}
				}elseif($interval->d == 1){
					return $interval->format('%d day ago');
				}else{
					return $interval->format('%d days ago');
				}
			}elseif($interval->m == 1){
				return $interval->format('%m month ago');
			}else{
				return $interval->format('%m months ago');
			}
		}elseif($interval->y == 1){
			return $interval->format('%y year ago');
		}else{
			return $interval->format('%y years ago');
		}
    }
}