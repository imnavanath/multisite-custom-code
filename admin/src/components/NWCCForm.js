import { __ } from '@wordpress/i18n';
import Icons from '@Admin/components/Icons';

function NWCCForm() {
	return (
		<>
			<div className="wp-nwccform sm:overflow-hidden">
				<div className="px-4 py-5 bg-white sm:p-6 grid grid-cols-1 gap-8 sm:grid-cols-2">

					<div className='relative mt-0'>
						<label htmlFor="header_css" className="flex text-sm font-medium text-gray-700">
							<span className='flex'>{ __( 'Header CSS', 'nwcc' ) }</span>
							<div className="relative flex flex-col group tooltip-group">
								{ Icons.help }
								<div className="absolute bottom-0 right-6 flex tooltip-group flex-col hidden group-hover:flex">
									<span className="relative rounded-sm z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg"> { __( 'These style will be printed to the head section.', 'nwcc' ) } </span>
								</div>
							</div>
						</label>
						<div className="mt-3">
							<textarea
							id="header_css"
							name="nwcc_setting[header_css]"
							rows={8}
							className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
							placeholder={'<!-- Add your custom CSS here. -->'}
							defaultValue={ nwcc_setting.nwcc_setting.header_css }
							/>
						</div>
					</div>

					<div className='relative mt-0'>
						<label htmlFor="header_js" className="flex text-sm font-medium text-gray-700">
							<span className='flex'>{ __( 'Header JS', 'nwcc' ) }</span>
							<div className="relative flex flex-col group tooltip-group">
								{ Icons.help }
								<div className="absolute bottom-0 right-6 flex tooltip-group flex-col hidden group-hover:flex">
									<span className="relative rounded-sm z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg"> { __( 'These script will be printed to the head section.', 'nwcc' ) } </span>
								</div>
							</div>
						</label>
						<div className="mt-3">
							<textarea
							id="header_js"
							name="nwcc_setting[header_js]"
							rows={8}
							className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
							placeholder={ '<!-- Add your custom JS here. -->' }
							defaultValue={ nwcc_setting.nwcc_setting.header_js }
							/>
						</div>
					</div>

					<div className='relative mt-6'>
						<label htmlFor="footer_css" className="flex text-sm font-medium text-gray-700">
							<span className='flex'>{ __( 'Footer CSS', 'nwcc' ) }</span>
							<div className="relative flex flex-col group tooltip-group">
								{ Icons.help }
								<div className="absolute bottom-0 right-6 flex tooltip-group flex-col hidden group-hover:flex">
									<span className="relative rounded-sm z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg"> { __( 'These style will be printed to the footer section.', 'nwcc' ) } </span>
								</div>
							</div>
						</label>
						<div className="mt-3">
							<textarea
							id="footer_css"
							name="nwcc_setting[footer_css]"
							rows={8}
							className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
							placeholder={ '<!-- Add your custom CSS here. -->' }
							defaultValue={ nwcc_setting.nwcc_setting.footer_css }
							/>
						</div>
					</div>

					<div className='relative mt-6'>
						<label htmlFor="footer_js" className="flex text-sm font-medium text-gray-700">
							<span className='flex'>{ __( 'Footer JS', 'nwcc' ) }</span>
							<div className="relative flex flex-col group tooltip-group">
								{ Icons.help }
								<div className="absolute bottom-0 right-6 flex tooltip-group flex-col hidden group-hover:flex">
									<span className="relative rounded-sm z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg"> { __( 'These script will be printed to the footer section.', 'nwcc' ) } </span>
								</div>
							</div>
						</label>
						<div className="mt-3">
							<textarea
							id="footer_js"
							name="nwcc_setting[footer_js]"
							rows={8}
							className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
							placeholder={ '<!-- Add your custom JS here. -->' }
							defaultValue={ nwcc_setting.nwcc_setting.footer_js }
							/>
						</div>
					</div>

				</div>
			</div>
		</>
	);
}

export default NWCCForm;
