import AppTitle from '@/Components/AppTitle';
import AppNav from '@/Components/AppNav';
import AppFooter from '@/Components/AppFooter';
import AppConnexionDisplay from '@/Components/AppConnexionDisplay';
import AppDateTime from '@/Components/AppDateTime';
import { Head, Link } from '@inertiajs/react';

export default function Resources(props) {
    // console.log(props.resources);
    // Working on usefull props to display the news
    const resourcesArray = props.resources;
    const resourcesCount = resourcesArray.length;
    let resourcesItems = [];
    let addNewsButton = '';
    for(let i=0; i<resourcesCount; i++) {
        let editLink = '';
        /*if(props.auth.user.identity == 'teacher' || props.auth.user.id == resourcesArray[i].author_id) {
            let HrefId = "/ressources/"+resourcesArray[i].id+"/edit";
            resourcesItems.push(<article key={resourcesArray[i].id} id={"res"+resourcesArray[i].id} className={resourcesArray[i].state}><h3>{resourcesArray[i].title}</h3><p><Link href={HrefId}>Modifier</Link></p><p>Etat : {resourcesArray[i].state}</p><p>URL : {resourcesArray[i].url}</p><p>Mots-clés : {resourcesArray[i].keywords.join(', ')}</p><p>Type : {resourcesArray[i].type}</p></article>);
        } else {
            resourcesItems.push(<article key={resourcesArray[i].id} id={"res"+resourcesArray[i].id} className={resourcesArray[i].state}><h3>{resourcesArray[i].title}</h3><p>Etat : {resourcesArray[i].state}</p><p>URL : {resourcesArray[i].url}</p><p>Mots-clés : {resourcesArray[i].keywords.join(', ')}</p><p>Type : {resourcesArray[i].type}</p></article>);
        }*/
        if(props.auth.user.role >= 10 || props.auth.user.id == resourcesArray[i].author_id) {
            editLink = <div className="edit-link"><Link title="Modifier" href={"/ressources/"+resourcesArray[i].id+"/edit"}>&#9998;</Link></div>;
        }
        resourcesItems.push(<article key={resourcesArray[i].id} id={"res"+resourcesArray[i].id} className={resourcesArray[i].state}>{editLink}<h3><Link href={"/ressources/#res"+resourcesArray[i].id}>#</Link> {resourcesArray[i].title}</h3><p className="el-content">Lien : <a href={resourcesArray[i].url} target="_blank">{resourcesArray[i].url}</a></p><div className="el-infos">Mis à jour : {resourcesArray[i].updated_at}  <span className="separator">&bull;</span> Auteur : {resourcesArray[i].author_display_name}</div></article>);
        // Generating the Add Button to add new news
        if(props.auth.user.role >= 10) {
            addNewsButton = <div className="add-el"><Link href="/ressources/create" title="Ajouter une ressource">+</Link></div>;
        }
    };
    return (
        <>
            <Head title="Prim'ENT - Ressources" />
            <div className="resources-page">
                
                <header>
                    <div className="status-bar">
                        <AppConnexionDisplay data={props.auth.user} /> <AppDateTime />
                    </div>
                    <div className="top-header">
                        <AppTitle />
                        <AppNav data="resourcesP" />
                    </div>
                </header>

                <main id="main" className="resources-listing">
                {addNewsButton}
                <h2>Prim'RESSOURCES</h2>
                    <div className="el-content">
                        {(resourcesArray) ?
                            <>                        
                                {resourcesItems}
                            </>
                        :
                            <>
                                <p>Aucune ressource à vous afficher ici&hellip;</p>
                            </>
                        }
                    </div>  
                </main>

                <AppFooter />

            </div>
        </>
    );
}
