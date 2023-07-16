import { Link } from '@inertiajs/react';
export default function AppTitle() {
    return (
        <div className="title">
            <h1>
            <Link href={route('home')} className="">
                Prim'ENT
            </Link></h1>
            <p>Travailler ensemble&hellip;simplement&nbsp;!</p>
        </div>
    );
}
