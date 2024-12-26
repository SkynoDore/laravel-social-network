import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <form onSubmit={submit} className="p-4 border rounded shadow-sm bg-light">
                {/* Nombre */}
                <div className="mb-3">
                    <label htmlFor="name" className="form-label">
                        Nombre
                    </label>
                    <input
                        id="name"
                        name="name"
                        value={data.name}
                        className="form-control"
                        autoComplete="name"
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />
                    {errors.name && <div className="text-danger mt-1">{errors.name}</div>}
                </div>

                {/* Email */}
                <div className="mb-3">
                    <label htmlFor="email" className="form-label">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="form-control"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />
                    {errors.email && <div className="text-danger mt-1">{errors.email}</div>}
                </div>

                {/* Contraseña */}
                <div className="mb-3">
                    <label htmlFor="password" className="form-label">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="form-control"
                        autoComplete="new-password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />
                    {errors.password && <div className="text-danger mt-1">{errors.password}</div>}
                </div>

                {/* Confirmar Contraseña */}
                <div className="mb-3">
                    <label htmlFor="password_confirmation" className="form-label">
                        Confirmar contraseña
                    </label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="form-control"
                        autoComplete="new-password"
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        required
                    />
                    {errors.password_confirmation && (
                        <div className="text-danger mt-1">{errors.password_confirmation}</div>
                    )}
                </div>

                {/* Acciones */}
                <div className="d-flex justify-content-between align-items-center mt-4">
                    <Link href={route('login')} className="text-decoration-none text-secondary">
                        ¿Ya estás registrado?
                    </Link>
                    <button type="submit" className="btn btn-primary" disabled={processing}>
                        Registrar
                    </button>
                </div>
            </form>
        </GuestLayout>
    );
}
