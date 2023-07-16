import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head, useForm } from '@inertiajs/react';

export default function Singleresourceedit(props) {
    console.log(props.resource);
    // Working on usefull props to display the resources
    const postData = props.resource;
    const { data, setData, post, processing, errors } = useForm({
        title: postData.title,
        url: postData.url,
        state: postData.state,
        id:postData.id,
      })
    function submit(e) {
        e.preventDefault();
        post('/ressources/' + postData.id + '/edit');
    }
    
    return (
        <>
            <Head title="Prim'ENT - Edition d'une actualité" />
            <div className="resource-edit-page">
                
                <header>
                    <div className="status-bar">
                        <AppConnexionDisplay data={props.auth.user} /> <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav data="resourcesP" />
                    </div>
                </header>

                <main id="main" className="resource-edit">
                    <h2>Edition de la ressource {data.id}</h2>
                <form onSubmit={submit}>
                    <p>
                        <label htmlFor="title">Titre (description)</label><br />
                        <input required="required" id="title" type="text" value={data.title} onChange={e => setData('title', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="url">URL</label><br />
                        <input required="required" id="url" type="text" value={data.url} onChange={e => setData('url', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="state">État de publication</label><br />
                        <input required="required" id="state" type="text" value={data.state} onChange={e => setData('state', e.target.value)} />
                    </p>
                    <p className="el-center">
                        <button type="submit" disabled={processing}>Valider</button>
                    </p>
                </form>                    
                </main>

                <AppFooter />

            </div>
        </>
    );
}
