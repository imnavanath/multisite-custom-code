import { __ } from '@wordpress/i18n';
import Icons from '@Admin/components/Icons';

function Header() {
	return (
		<div className="sticky top-[30px] right-0 bg-white border-b -ml-5 px-2 py-2 border-t border-gray-200 sm:px-6 z-10">
			<div className="flex justify-between items-center flex-wrap sm:flex-nowrap">
				<h2 className="text-lg leading-4 font-medium text-gray-500">
					<span className="inline-block align-middle mr-2"><span className="dashicons dashicons-admin-multisite"></span></span>
					<span className="align-middle"> { __( 'Network Wide Custom Code', 'nwcc' ) } </span>
				</h2>
				<div className="relative flex rounded-md shadow-sm">
						<a href="https://profiles.wordpress.org/navanathbhosale" title={ __( 'WordPress', 'nwcc' ) } target="_blank" id="wordpress" className="cursor-pointer shadow-sm mr-1.5 px-1.5 py-1.5 text-wpcolor hover:text-gray-900 rounded-full hover:bg-gray-50 bg-gray-100 flex items-center justify-center focus:outline-none">
							{ Icons.wordpress }
						</a>
						<a href="https://github.com/imnavanath/network-wide-custom-code" title={ __( 'GitHub', 'nwcc' ) } target="_blank" id="github" className="cursor-pointer shadow-sm mr-1.5 px-1.5 py-1.5 text-wpcolor hover:text-gray-900 rounded-full hover:bg-gray-50 bg-gray-100 flex items-center justify-center focus:outline-none">
							{ Icons.github }
						</a>
						<a href="https://www.linkedin.com/in/navanath-bhosale" title={ __( 'Connect via LinkedIn', 'nwcc' ) } target="_blank" id="linkedin" className="cursor-pointer shadow-sm mr-1.5 px-1.5 py-1.5 text-wpcolor hover:text-gray-900 rounded-full hover:bg-gray-50 bg-gray-100 flex items-center justify-center focus:outline-none">
							{ Icons.linkedin }
						</a>
						<a href="mailto:navanath.bhosale95@gmail.com" title={ __( 'Email me', 'nwcc' ) } target="_blank" id="email" className="cursor-pointer shadow-sm mr-1.5 px-1.5 py-1.5 text-wpcolor hover:text-gray-900 rounded-full hover:bg-gray-50 bg-gray-100 flex items-center justify-center focus:outline-none">
							{ Icons.email }
						</a>
						<a href="https://www.paypal.com/paypalme/NavanathBhosale" title={ __( 'Donation link', 'nwcc' ) } target="_blank" id="paypal" className="cursor-pointer shadow-sm px-1.5 py-1.5 text-wpcolor hover:text-gray-900 rounded-full hover:bg-gray-50 bg-gray-100 flex items-center justify-center focus:outline-none">
							{ Icons.paypal }
						</a>
				</div>
			</div>
		</div>
	);
}

export default Header;
