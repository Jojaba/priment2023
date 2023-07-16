import { Link } from '@inertiajs/react';
export default function AppNav({data}) {
    // Get the active menu
    let nClass, hwClass, taClass, resClass;
    (data == 'newsP') ? nClass = 'active' : nClass = '';
    (data == 'homeworksP') ? hwClass = 'active' : hwClass = '';
    (data == 'talksP') ? taClass = 'active' : taClass = '';
    (data == 'resourcesP') ? resClass = 'active' : resClass = '';   
    return (
        <nav className="menu">
            <ul>
                <li className="news">
                    <Link href={route('news')} className={nClass}>
                        Actualités
                    </Link>
                </li>
                <li className="howo">
                    <Link href={route('homeworks')} className={hwClass}>
                        Devoirs
                    </Link>
                </li>
                <li className="talk">
                    <Link href={route('talks')} className={taClass}>
                        Discussions
                    </Link>
                </li>
                <li className="reso">
                    <Link href={route('resources')} className={resClass}>
                        Ressources
                    </Link>
                </li>
            </ul>
        </nav>
    );
}
