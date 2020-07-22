
package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;
@Entity
@Table(name="JustificativoAsistenciaDia", schema="dayclass")
public class JustificativoAsistenciaDia implements Serializable {
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private int nroRengloJustificativo;
    @ManyToOne
    private Justificativo justificativo;
    @ManyToOne
    private AsistenciaDia asistenciaDia;
    
    public JustificativoAsistenciaDia() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    public int getNroRengloJustificativo() {
        return nroRengloJustificativo;
    }

    public Justificativo getJustificativo() {
        return justificativo;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNroRengloJustificativo(int nroRengloJustificativo) {
        this.nroRengloJustificativo = nroRengloJustificativo;
    }

    public void setJustificativo(Justificativo justificativo) {
        this.justificativo = justificativo;
    }
    
    
    
}
