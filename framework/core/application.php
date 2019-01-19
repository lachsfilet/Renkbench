<?php
/****************************************************************************
 *  ./core/application.php
 *
 *  2008-10-05
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
    //Includes
    require_once(PATH_FRAMEWORK.'/db/mysql.php');
    require_once(PATH_FRAMEWORK.'/core/session.php');
    
    /**
    * The application class
    */
    class Application
    {
        var $_initData;
        var $_session;
        var $_db;
        
        /**
        * The application constructor
        */
        function Application($initData)
        {
            $this->_initData=$initData;
			if($initData['session'])
				$this->_session=new Session();
            $this->_db=$initData['db'];
			
		    foreach($initData['components'] as $name=>$record)
			{
				require_once(PATH_PROJECT.'/components/'.$name.'.php');
			}
		}
        
        /**
        * The core function of application running.
        */
        function run()
        {
            $path=$_SERVER['PATH_INFO'];
            $pathArray=explode('/',$path);
            if(!$pathArray[1])
                $pathArray=explode('/',$this->_initData['default']);
            return $this->execute($pathArray[1],$pathArray[2],$pathArray[3]);
        }
        
        /**
        * Executes a given command of the given element.
        */
        function execute($element, $command, $id=0)
        {
            $component=new $this->_initData['components'][$element]['component']($this->_initData['components'][$element]);
            if(!$component)
                return false;
            if($component->execute($command, $id))
				$component->sendResponse();
			return true;
        }
		
		/**
		*
		*/
		function getDataFromComponent($element, $id=0)
		{
            $component=new $this->_initData['components'][$element]['component']($this->_initData['components'][$element]);
            if(!$component)
                return false;
			if($component->execute($command, $id))
				return $component->getData();
		}
        
        /**
        * Returns the current session.
        */
        function getSession()
        {
            return $this->_session;
        }

        function startSession()
        {
            $this->_session=new Session();
        }
        
        /**
        * Returns the curent db connection.
        */
        function getDbConnection()
        {
            return $this->_db;
        }
    }
?>
