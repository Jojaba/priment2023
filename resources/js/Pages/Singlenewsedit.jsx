import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head, useForm } from '@inertiajs/react';

export default function Singlenewsedit(props) {
    console.log(props.post);
    // Working on usefull props to display the news
    const postData = props.post;
    const { data, setData, post, processing, errors } = useForm({
        title: postData.title,
        content: postData.content,
        target: postData.target,
        associated_res: postData.associated_res,
        keywords: postData.keywords,
        pinned: postData.pinned,
        state: postData.state,
        id:postData.id,
      })
    function submit(e) {
        e.preventDefault();
        post('/actualites/' + postData.id + '/edit');
    }
    
    return (
        <>
            <Head title="Prim'ENT - Edition d'une actualité" />
            <div className="news-edit-page">
                
                <header>
                    <div className="status-bar">
                        <AppConnexionDisplay data={props.auth.user} /> <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav data="newsP" />
                    </div>
                </header>

                <main id="main" className="news-listing">
                    <h2>Edition de l'actualité {data.id}</h2>
                <form onSubmit={submit}>
                    <p>
                        <label htmlFor="title">Titre</label><br />
                        <input required id="title" type="text" value={data.title} onChange={e => setData('title', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="content">Contenu de l'article</label><br />
                        <textarea required rows="5" id="content" onChange={e => setData('content', e.target.value)} value={data.content}></textarea>
                    </p>
                    <p>
                        <label htmlFor="associated_res">Ressource associée</label><br />
                        <input id="associated_res" type="text" value={data.associated_res} onChange={e => setData('associated_res', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="target">Public ciblé</label><br />
                        <input required id="target" type="text" value={data.target} onChange={e => setData('target', e.target.value)} />
                    </p>
                    <p>
                        <label required htmlFor="state">État de publication</label><br />
                        <input id="state" type="text" value={data.state} onChange={e => setData('state', e.target.value)} />
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
