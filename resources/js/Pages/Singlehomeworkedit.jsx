import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head, useForm } from '@inertiajs/react';

export default function Singlehomeworkedit(props) {
    console.log(props.post);
    // Working on usefull props to display the homework
    const postData = props.post;
    const { data, setData, post, processing, errors } = useForm({
        content:        postData.content,
        classroom:      postData.classroom,
        date:           postData.date,
        time:           postData.time,
        associated_res: postData.associated_res,
        state:          postData.state,
        id:             postData.id
      })
    function submit(e) {
        e.preventDefault();
        post('/devoirs/' + postData.id + '/edit');
    }
    
    return (
        <>
            <Head title="Prim'ENT - Edition d'une actualité" />
            <div className="homework-edit-page">
                
                <header>
                    <div className="status-bar">
                        <AppConnexionDisplay data={props.auth.user} /> <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav data="homeworksP" />
                    </div>
                </header>

                <main id="main" className="homework-edit">
                    <h2>Edition des devoirs {data.id}</h2>
                <form onSubmit={submit}>
                    <p>
                        <label htmlFor="date">Date (jj/mm/aaaa)</label><br />
                        <input required="required" id="date" type="text" value={data.date} onChange={e => setData('date', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="time">Horaire (hh:mm)</label><br />
                        <input required="required" id="time" type="text" value={data.time} onChange={e => setData('time', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="content">Contenu des devoirs</label><br />
                        <textarea required="required" rows="5" id="content" onChange={e => setData('content', e.target.value)} value={data.content}></textarea>
                    </p>
                    <p>
                        <label htmlFor="associated_res">Ressource associée</label><br />
                        <input id="associated_res" type="text" value={data.associated_res} onChange={e => setData('associated_res', e.target.value)} />
                    </p>
                    <p>
                        <label htmlFor="classroom">Classe</label><br />
                        <input required="required" id="classroom" type="text" value={data.classroom} onChange={e => setData('classroom', e.target.value)} />
                    </p>
                    <p>
                        <label  htmlFor="state">État de publication</label><br />
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
