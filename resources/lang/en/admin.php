<?php

return [

    'users' => [

    	'delete' => [

	        'confirm' => [

	            'title'       => 'Confirm delete',
	            'description' => 'You are about to delete :name. Are you really, really, really sure you want to do this? Don\'t worry though, you can just restore the user later.',

	        ],

	    ],
	    'restore' => [

	    	'confirm' => [

	            'title'       => 'Confirm restore',
	            'description' => 'You are about to restore :name. This means the user will come back to life, sort of. You sure you want that? Don\'t worry though, you can just kill the user later if you feel like it.',

	        ],

	    ],
	    'create' => [

	    	'password_confirmation' => 'Confirm password',

	    ],

    ],

];
