import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head } from '@inertiajs/react';

export default function Singlenews(props) {
    // console.log(props.post);
    // Working on usefull props to display the news
    const postData = props.post;
    let editLink = '';
    if(props.auth.user.role >= 15 || props.auth.user.id == postData.author_id) {
        editLink = <div className="edit-link"><Link title="Modifier" href={"/actualites/"+postData.id+"/edit"}>&#9998;</Link></div>;
    }
    let articleData = <article key={postData.id} id={"news"+postData.id} className={postData.state}><h3><a href={"/actualites/#news"+postData.id}>#</a> {postData.title}</h3><p className="el-content">{editLink}{postData.content}</p><div className="el-infos">Mis à jour : {postData.updated_at} <span className="separator">&bull;</span> Public visé : {postData.target.join(',')} <span className="separator">&bull;</span> Auteur : {postData.author_display_name}</div></article>
    return (
        <>
            <Head title="Prim'ENT - Actualités" />
            <div className="news-page">
                
                <header>
                    <div className="status-bar">
                        <AppConnexionDisplay data={props.auth.user} /> <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav data="newsP" />
                    </div>
                </header>

                <main id="main" className="news-single">
                {(postData) ?
                        <>
                        <h2>Prim'ACTUALITÉS</h2>
                        <div class="news-content">
                            {articleData}
                        </div>
                        </>
                    :
                        <>
                            <h2>Prim'ACTUALITÉS</h2>
                            <div class="news-content">
                                <p>Désolé, cette actualité est introuvable&hellip;</p>
                            </div>
                        </>
                    }                    
                </main>

                <AppFooter />

            </div>
        </>
    );
}
