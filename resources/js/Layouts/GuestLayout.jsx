import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

export default function GuestLayout({ children, auth = { user: null } }) {
    return (

        <div className="w-100 ">
            <Navbar auth={auth}/>
            <div className='w-50 mx-auto p-5'>
            <div>
                <Link href="/">
                    <ApplicationLogo className="d-flex mx-auto" width="20px" height="20px" />
                </Link>
            </div>

            <div className="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
                {children}
            </div>
            </div>
            <Footer />
        </div>
    );
}
