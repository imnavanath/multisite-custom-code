import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom';

/* Main Compnent */
import '@Admin/Settings.scss';
import EntryContent from '@Admin/components/EntryContent';

ReactDOM.render(
	<BrowserRouter>
		<EntryContent />
	</BrowserRouter>,
	document.getElementById( 'wp-nwcc-settings' )
);
