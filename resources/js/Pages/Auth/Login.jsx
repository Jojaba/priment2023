import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppDateTime from '@/Components/AppDateTime';
import { Head, useForm } from '@inertiajs/react';

export default function Login({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: '',
    });

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    };

    return (
        <>
            <Head title="Prim'ENT - connexion" />
            <div className="login-page">
                
                <header>
                    <div className="status-bar">
                        <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav />
                    </div>
                </header>

                <main className="login-form">
                    {status && <div className="">{status}</div>}

                    <h2>Connexion</h2>

                    <form onSubmit={submit}>

                        <p>
                            <InputLabel forInput="email" value="Courriel" />
                            <TextInput
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className=""
                                autoComplete="username"
                                isFocused={true}
                                handleChange={onHandleChange}
                            />
                            <InputError message={errors.email} className="mt-2" />
                        </p>

                        <p>
                            <InputLabel forInput="password" value="Mot de passe" />
                            <TextInput
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className=""
                                autoComplete="current-password"
                                handleChange={onHandleChange}
                            />
                            <InputError message={errors.password} className="" />
                        </p>

                        <p>
                            <label>
                                <Checkbox name="remember" value={data.remember} handleChange={onHandleChange} /> <span>Se souvenir de moi</span>
                            </label>
                        </p>

                        <p className="el-center">
                            <PrimaryButton processing={processing}>
                                Connexion
                            </PrimaryButton>
                        </p>

                    </form>
                </main>

                <AppFooter />

            </div>
        </>
    );
}
