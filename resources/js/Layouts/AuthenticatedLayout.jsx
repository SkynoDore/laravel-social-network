import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';
import Navbar from '../Components/Navbar';
import Footer from '../Components/Footer';

export default function AuthenticatedLayout({ header, children,  auth = { user: null } }) {
    const user = usePage().props.auth.user;

    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

    return (
        <div className="min-vh-100 bg-light">
            {/* Navbar */}
             <Navbar auth={auth}/>

            {/* Header */}
            {header && (
                <header className="bg-white shadow">
                    <div className="container py-3">{header}</div>
                </header>
            )}

            {/* Main content */}
            <main className="container py-4">{children}</main>
            <Footer />
        </div>
    );
}
