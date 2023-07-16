import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head, Link } from '@inertiajs/react';

export default function News(props) {
    // console.log(props.posts);
    // Defining needed values
    const postsArray = props.posts;
    const postsCount = postsArray.length;
    let articleItems = [];
    let addNewsButton = '';
    // looping through the posts
    for(let i=0; i<postsCount; i++) {
        let editLink = '';
        /*if(props.auth.user.role >= 15 || props.auth.user.id == postsArray[i].author_id) {
            let HrefId = "/actualites/"+postsArray[i].id+"/edit";
            articleItems.push(<article key={postsArray[i].id} id={postsArray[i].id} className={postsArray[i].state}><h3>{postsArray[i].title}</h3><p><Link href={HrefId}>Modifier</Link></p><p>Etat : {postsArray[i].state}</p><p>Publication : {postsArray[i].updated_at}</p><p>Public visé : {postsArray[i].target.join(',')}</p><p>Auteur : {postsArray[i].author_display_name}</p><p>{postsArray[i].content}</p></article>);
        } else {
            articleItems.push(<article key={postsArray[i].id} id={postsArray[i].id} className={postsArray[i].state}><h3>{postsArray[i].title}</h3><p>Etat : {postsArray[i].state}</p><p>Publication : {postsArray[i].updated_at}</p><p>Public visé : {postsArray[i].target.join(',')}</p><p>Auteur : {postsArray[i].author_display_name}</p><p>{postsArray[i].content}</p></article>); 
        }*/
        if(props.auth.user.role >= 15 || props.auth.user.id == postsArray[i].author_id) {
            editLink = <div className="edit-link"><Link title="Modifier" href={"/actualites/"+postsArray[i].id+"/edit"}>&#9998;</Link></div>;
        }
        articleItems.push(<article key={postsArray[i].id} id={"news"+postsArray[i].id} className={postsArray[i].state}>{editLink}<h3><a href={"/actualites/#news"+postsArray[i].id}>#</a> {postsArray[i].title}</h3><p className="el-content">{postsArray[i].content}</p><div className="el-infos">Mis à jour : {postsArray[i].updated_at} <span className="separator">&bull;</span> Public visé : {postsArray[i].target} <span className="separator">&bull;</span> Auteur : {postsArray[i].author_display_name}</div></article>);
    };
    // Generating the Add Button to add new news
    if(props.auth.user.role >= 10) {
        addNewsButton = <div className="add-el"><Link href="/actualites/create" title="Ajouter une actualité">+</Link></div>;
    }
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

                <main id="main" className="news-listing">
                    {addNewsButton}
                    <h2>Prim'ACTUALITÉS</h2>
                        <div className="el-content">
                            {(postsArray) ?
                                <>                        
                                    {articleItems}
                                </>
                            :
                                <>
                                    <p>Aucun évènement à vous afficher ici&hellip;</p>
                                </>
                            }
                        </div>                    
                </main>

                <AppFooter />

            </div>
        </>
    );
}
