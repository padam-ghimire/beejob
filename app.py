
import flask,json
import nltk
import gensim
import numpy as np
from nltk.tokenize import word_tokenize,sent_tokenize

app = flask.Flask('your_flask_env')

def similarity(doc1,doc2):

   

    file_docs=doc1
    print("Number of documents:",len(file_docs))
    print(file_docs)

    #Tokenize Word And Creat Dic
    gen_docs = [[w.lower() for w in word_tokenize(text['bio'])] 
                for text in file_docs]
    dictionary = gensim.corpora.Dictionary(gen_docs)

    #Create Bag of Words
    corpus = [dictionary.doc2bow(gen_doc) for gen_doc in gen_docs]

    #TFIDF
    tf_idf = gensim.models.TfidfModel(corpus)


    #Similarity Measure Object
    sims = gensim.similarities.Similarity('workdir/',tf_idf[corpus],
                                        num_features=len(dictionary))
    #Open File 2
    file2_docs = doc2['description']

   
    query_doc = [w.lower() for w in word_tokenize(file2_docs)]
    query_doc_bow = dictionary.doc2bow(query_doc)
    # perform a similarity query against the corpus
    query_doc_tf_idf = tf_idf[query_doc_bow]
    bioList=[]
    count=0
    similarity =sims[query_doc_tf_idf].reshape(-1).tolist()
    print(similarity)
    bios=[]
    count=0
    for bio in doc1:
        bios.append({"id":bio['id'],"similarity":similarity[count],'bio':bio['bio']})
        count=count+1


    return {"job":doc2['id'],"bios":bios}

@app.route('/api', methods=['GET', 'POST'])
def register():
    data=[]
    if flask.request.method == 'POST':
        query = flask.request.values.get('query')
        query = json.loads(query)
        for applications in query:
             data.append(similarity(applications["bios"],applications["job"]))
    return json.dumps(data)
if __name__ == "__main__":
    app.run(debug=True)           