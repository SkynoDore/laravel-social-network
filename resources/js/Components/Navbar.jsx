import { Link, usePage } from '@inertiajs/react';

export default function Navbar({ auth }) {
    const { url } = usePage(); // Obtiene la URL actual de la página

    // Función para verificar si el nombre de la ruta actual coincide
    const isActive = (routeName) => {
        return route().current(routeName) ? 'active' : ''; // Devuelve 'active' si el nombre de la ruta coincide
    };

    return (
        <header className="d-flex justify-content-between align-items-center py-4 bg-dark px-5">
            <div className="d-none d-lg-block">
                {/* Agrega aquí el contenido si necesitas algo en la parte superior */}
            </div>
            <nav className="d-flex justify-content-end w-100">
                {auth.user ? (
                    <Link
                        href={route('dashboard')}
                        className={`link-claro text-decoration-none ${isActive('dashboard')}`}
                    >
                        Resumen
                    </Link>
                ) : (
                    <>
                        <Link
                            href={route('welcome')}
                            className={`link-claro mx-5 text-decoration-none ${isActive('welcome')}`}
                        >
                            Inicio
                        </Link>
                        <Link
                            href={route('about')}
                            className={`link-claro mx-5 text-decoration-none ${isActive('about')}`}
                        >
                            Sobre mí
                        </Link>
                        <Link
                            href={route('login')}
                            className={`link-claro mx-5 text-decoration-none ${isActive('login')}`}
                        >
                            Iniciar sesión
                        </Link>
                        <Link
                            href={route('register')}
                            className={`link-claro mx-5 text-decoration-none ${isActive('register')}`}
                        >
                            Registrarse
                        </Link>
                    </>
                )}
            </nav>
        </header>
    );
}
