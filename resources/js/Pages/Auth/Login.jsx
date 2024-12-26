import { Head, Link, useForm } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            {status && (
                <div className="alert alert-success mb-4" role="alert">
                    {status}
                </div>
            )}

            <form onSubmit={submit} className="needs-validation p-4 border rounded shadow-sm bg-light">
                <div className="mb-3">
                    <label htmlFor="email" className="form-label">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className={`form-control ${errors.email ? 'is-invalid' : ''}`}
                        autoComplete="username"
                        autoFocus
                        onChange={(e) => setData('email', e.target.value)}
                    />
                    {errors.email && <div className="invalid-feedback">{errors.email}</div>}
                </div>

                <div className="mb-3">
                    <label htmlFor="password" className="form-label">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className={`form-control ${errors.password ? 'is-invalid' : ''}`}
                        autoComplete="current-password"
                        onChange={(e) => setData('password', e.target.value)}
                    />
                    {errors.password && <div className="invalid-feedback">{errors.password}</div>}
                </div>

                <div className="mb-3 form-check">
                    <input
                        type="checkbox"
                        className="form-check-input"
                        id="remember"
                        name="remember"
                        checked={data.remember}
                        onChange={(e) => setData('remember', e.target.checked)}
                    />
                    <label className="form-check-label" htmlFor="remember">
                        Mantener sesión iniciada
                    </label>
                </div>

                <div className="d-flex justify-content-between align-items-center">
                    {canResetPassword && (
                        <Link
                            href={route('password.request')}
                            className="text-decoration-none text-primary"
                        >
                            ¿Has olvidado tu contraseña?
                        </Link>
                    )}
                    <button
                        type="submit"
                        className="btn btn-primary"
                        disabled={processing}
                    >
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </GuestLayout>
    );
}
