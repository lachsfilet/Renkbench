<?php
/****************************************************************************
 *  ./core/component.php
 *
 *  2008-10-06
 *  Copyright 2008 by Jan Renken, Hamburg
 *  Author: Jan Renken
 *  Email:  j-renken@foni.net
 ****************************************************************************/

/*
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Library General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */
    /**
    * Abstract class, extend this class to create a component.
    */
    abstract class Component
    {
        var $_initData;
        var $_responseData;
		
        /**
        * The basic constructor
        */
        function Component($initData)
        {
            $this->_initData=$initData;
        }
        
        /**
        * Abstract function execute executes the given command with the given
        * id. To implement this function you have to extend this class and
        * overwrite this function.
        */
        abstract function execute($command, $id);
		
		/**
		* Sends the requested data to the client.
		*/
		function sendResponse()
		{
			switch($this->_initData['responseType'])
			{
				case 'image':
					//TODO: add image header and data
					header('Content-type: image/png');
					break;
				case 'file':
					$filename=preg_replace("/.*\/(.+)$/","$1",$this->_responseData);
					header('Content-Disposition: attachment; filename="'.$filename.'"');
					readfile($this->_responseData);
					break;
				case 'json':
				default:
					header('Content-type: application/json');
					echo json_encode($this->_responseData);
			}
		}
		
		/**
		* Just returns the raw response data.
		*/
		function getData()
		{
			return $this->_responseData;
		}
	}
?>
