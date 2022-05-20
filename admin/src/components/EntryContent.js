import { useState } from 'react';
import { useLocation } from 'react-router-dom';
import { __ } from '@wordpress/i18n';
import apiFetch from '@wordpress/api-fetch';
import Header from '@Admin/components/Header';
import NWCCForm from '@Admin/components/NWCCForm';
import Footer from '@Admin/components/Footer';

function EntryContent() {
	const [ saved, setSaved ] = useState( '' );

	function handleFormSubmit( e ) {
		e.preventDefault();
		const formData = new window.FormData();
		for ( let i = 0; i < e.target.length; i++ ) {
			formData.append( e.target[ i ].name, e.target[ i ].value );
		}

		formData.append( 'action', 'nwcc_update_settings' );
		formData.append( 'security', nwcc_setting.update_nonce );

		apiFetch( {
			url: nwcc_setting.ajax_url,
			method: 'POST',
			body: formData,
		} ).then( () => {
			setSaved( 'saved' );
			setTimeout( () => {
				setSaved( '' );
				window.location.reload( false );
			}, 1000 );
		} );
	}

	const query = new URLSearchParams( useLocation().search );
	const page = query.get( 'page' );
	const path = query.get( 'path' );

	return (
		( 'nwcc_setting' === page ) &&
			<>
				<form
					className="nwccSetting"
					id="nwccSetting"
					method="post"
					onSubmit={ handleFormSubmit }
				>
					<Header saved={ saved } />
					<main className="max-w-[80rem] px-1 py-1 mx-auto mt-[2.5rem] bg-white rounded-lg shadow">
						<div className="lg:grid lg:gap-x-0">
							<div className="relative m-0 sm:px-6 lg:px-0 lg:col-span-9">
								<NWCCForm />
							</div>
						</div>
					</main>
					<Footer saved={ saved } />
				</form>
			</>
	);
}

export default EntryContent;
