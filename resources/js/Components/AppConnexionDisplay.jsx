import { Link } from '@inertiajs/react';
export default function AppConnexionDisplay({data}) {
    return (
        <span className="connexion">
            {data ?
                <>
                    <span id={"id-"+data.id} className={data.identity}>
                        {data.forename} {data.name.charAt(0)}
                    </span>&nbsp;
                    <Link title="Déconnexion" href={route('logout')} method="post" className="">[x]</Link>
                </>
                : (
                <>
                    <Link title="Se connecter" href={route('login')} className="">[&#9786;]</Link>

                </>
            )}
        </span>
    );
}
